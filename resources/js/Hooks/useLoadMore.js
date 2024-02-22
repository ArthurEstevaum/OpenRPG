import { router } from "@inertiajs/react"
import { useEffect } from "react"

export default function useLoadMore(apiProps, sourceName) {
    const [currentProps, setCurrentProps] = useState([])
    
    function loadMore() {
        if(!apiProps.links.next) {
            return
        }

        router.get(apiProps.links.next, {}, {
            only:[sourceName],
            preserveScroll: true,
            preserveState: true,
        })
    }

    useEffect(() => {
        setCurrentProps([...currentProps, ...apiProps.data])
    }, [apiProps.data])
    
    return [currentProps, loadMore]
}