import { useState, useEffect } from "react";
import { router } from "@inertiajs/react";

/**
 * 
 * Hook made to fetch and load more data
 * from laravel paginated data
 * @param {object} apiProps The paginated props sended by laravel
 * @param {String} sourceName Name of the source sended by backend, generally the same name of api props, as a string
 * @returns {Array}
 */
export default function usePagination(apiProps, sourceName) {
    //the sourceName prop is required once inertia
    //needs the name of the prop that will be fetched
    //on the partial reload
    const [data, setData] = useState([])
    const [shouldUpdateData, setShouldUpdateData] = useState(true)

    useEffect(() => {
        if(shouldUpdateData) {
            setData((data) => [...data, ...apiProps.data])
        } else {
            setData([...apiProps.data])
        }
    }, [apiProps.data])

    function loadMoreData() {
        setShouldUpdateData(true)
        if(!apiProps.links.next) {
            return
        }
        router.get(apiProps.links.next, {}, {
            only: [sourceName],
            preserveScroll: true,
            preserveState: true,
        })
    }

    return [data, loadMoreData, setShouldUpdateData, setData]
}