import { useState, useEffect } from "react";
import { router } from "@inertiajs/react";

/**
 * 
 * Hook made to fetch and load more data
 * from laravel paginated data
 * @param {object} apiProps The paginated props sended by laravel
 * @param {String} sourceName The name of the source sended by backend, generally the same name of api props, as a string
 * @returns 
 */
export default function usePagination(apiProps, sourceName) {
    //the sourceName prop is required once inertia
    //needs the name of the prop that will be fetched
    //on the partial reload
    const [data, setData] = useState([])

    useEffect(() => {
        setData((data) => [...data, ...apiProps.data])
    }, [apiProps.data])

    function loadMoreData() {
        if(!apiProps.links.next) {
            return
        }
        router.get(apiProps.links.next, {}, {
            only: [sourceName],
            preserveState: true,
        })
    }

    return [data, loadMoreData]
}