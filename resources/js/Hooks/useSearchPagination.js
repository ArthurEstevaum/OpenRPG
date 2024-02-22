import { useState, useEffect, useMemo } from "react"
import { router } from "@inertiajs/react"
import usePagination from "./usePagination"
import debounce from "lodash.debounce"

/**
 * useSearchPagination provides usePagination features,
 * but adding to it a live search implementation, that waits
 * user stop write and extract the input value to make a async
 * request to the backend search the term sended by input.
 * 
 * @param {object} apiProps The paginated props sended by laravel
 * @param {string} sourceName Name of the source sended by backend, generally the same name of api props, as a string
 * @returns {Array}
 */
export default function useSearchPagination(apiProps, sourceName) {
    const [data, loadMoreData, setShouldUpdateData, setData] = usePagination(apiProps, sourceName)
    const [search, setSearch] = useState('')
    const urlBasePath = apiProps.meta.path

    const debouncedSearch = useMemo(() => {
        return debounce((e) => {
            if(e.target.value == '') {
                //when the user searchs, then exclude all
                //characters, the page reload the complete pagination
                router.get(urlBasePath, {}, {preserveScroll: true, 
                    preserveState: true,
                    replace: true,
                    only: [sourceName],
                onSuccess: () => {
                    setData([])
                    setShouldUpdateData(true)
                }})
            } 
            setSearch(() => e.target.value)
            setShouldUpdateData(false)
        }, 500)
    }, [])

    //Updates the page with the data of search term
    useEffect(() => {
        if(search !== '') {
            router.get(urlBasePath, {search}, {only:[sourceName], 
            preserveScroll: true, preserveState: true, replace: true})
        }
    }, [search])

    //Avoids side effects of debounce function
    useEffect(() => {
        return () => {
            debouncedSearch.cancel()
        }
    })

    return [data, loadMoreData, debouncedSearch, setShouldUpdateData]
}