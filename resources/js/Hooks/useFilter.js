import { router } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function useFilter(apiProps, sourceName, ...filters) {

    const [currentProps, setCurrentProps] = useState([])

    useEffect(() => {
        //apiProps.meta.path = Url without query parameters
        router.get(apiProps.meta.path, {...filters}, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
            only: [sourceName],
        })
    }, [...filters])

    useEffect(() => {
        setCurrentProps([...apiProps.data])
    }, [apiProps.data])

    return currentProps
}