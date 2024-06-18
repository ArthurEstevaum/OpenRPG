import { useState } from 'react'
import { router } from '@inertiajs/react'

/**
 * A hook that relies on the inertia router to provide
 * new data and merges the old data into the new data as an infinite scrolling
 * IMPORTANT: This hook needs an useDidUpdateEffect hook(an useEffect hook that doesn't
 * run on first render) to be integrated with a hook of the same type(example: useSearch)
 * Example usage: 
 *  useDidUpdateEffect(() => {
        setDataToDisplay([...loadedData])
    }, [loadedData])
 * @param {object} apiProps prop passed to the component [ATTENTION] : This hook relies on the prop object sended by laravel pagination.
 * @param {string} sourceName Name of the prop passed to the component, as a string
 * @returns {Array} Returns the array which merges the current data with the new data, and the function which must be passed to the event handler(the function makes the request for more data)
 */
export default function useLoadMore(apiProps, sourceName) {
    
    const [currentProps, setCurrentProps] = useState([...apiProps.data])

    function loadMore() {
        if(!apiProps.links.next) {
            return
        }
        router.get(apiProps.links.next, {}, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
            only: [sourceName],
            onSuccess: (res) => {
                const newData = res.props[sourceName].data
                setCurrentProps([...currentProps, ...newData])
            }
        })
    }

    return [currentProps, loadMore, setCurrentProps]
}