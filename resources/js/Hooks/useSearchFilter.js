import { useEffect, useState, useMemo } from 'react'
import { router } from '@inertiajs/react'
import debounce from 'lodash.debounce'

/**
 * A hook that relies on the inertia router to provide
 * new data filtered with the search term provided by the
 * user. Dinamically, but debounced to avoid too much requests.
 * IMPORTANT: This hook needs an useDidUpdateEffect hook(an useEffect hook that doesn't
 * run on first render) to be integrated with a hook of the same type(example: useLoadMore)
 * Example usage with loadMore: 
 *  useDidUpdateEffect(() => {
        setLoadedData([...searchedData]);
    }, [searchedData]);
    in such cases, only one hook should set the data to be displayed
    and other hooks should update the state of the hook responsible for update
    the data to be displayed. In this particular case, the useLoadMore hook.
 * @param {object} apiProps prop passed to the component [DISCLAIMER] : This hook relies on the prop object sended by laravel pagination.
 * @param {string} sourceName Name of the prop passed to the component, as a string
 * @returns {Array, string} Return the array containing the filtered data by the search, and the string(search term) returned by the debounce function.
 */
export default function useSearchFilter(apiProps, sourceName) {
    const [search, setSearch] = useState('')
    const [filteredData, setFilteredData] = useState([...apiProps.data])

    const debouncedSearch = useMemo(() => {
        return debounce((e) => {
            if(e.target.value === '') {
                //when the user searchs, then exclude all
                //characters, the page reload the complete pagination
                router.get(apiProps.meta.path, {}, {
                    preserveScroll: true, 
                    preserveState: true,
                    replace: true,
                    only: [sourceName],
                    onSuccess: (res) => {
                        setFilteredData([...res.props[sourceName].data])
                    }
                })
            }
            setSearch(() => e.target.value)

        }, 500)
    }, [])
    //Clear any side effects of debounce function
    useEffect(() => {
        return () => {
            debouncedSearch.cancel()
        }
    })

    //when the search input is modified by user, performs a xhr request
    useEffect(() => {
        if(search !== '') {
            router.get(apiProps.meta.path,
            {search: search}, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                only: [sourceName],
                onSuccess: (res) => {
                    setFilteredData([...res.props[sourceName].data])
                }
            })
        }
    }, [search])

    return [filteredData, debouncedSearch]
}