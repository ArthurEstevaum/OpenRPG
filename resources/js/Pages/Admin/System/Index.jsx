import { useState, useEffect } from "react"
import { Link, router } from "@inertiajs/react"

export default function Index({ systems }) {

    const [systemList, setSystemList] = useState([])

    useEffect(() => {
        setSystemList((systemList) => [...systemList, ...systems.data])
    }, [systems.data])

    function loadMore() {
        if(!systems.links.next) {
            return
        }
        router.get(systems.links.next, {}, {
            only: ['systems'],
            preserveState: true,
        })
    }

        return (
        <div>
            <ul>
                {systemList.map(system => <li className='text-xl' key={system.id}>{system.name}</li>)}
            </ul>
            
            {systems.links.next && <button className='border-2 rounded-md p-3 m-auto border-blue-500 text-blue-500 text-4xl' onClick={loadMore}>Carregar mais</button>}
        </div>
    )
}