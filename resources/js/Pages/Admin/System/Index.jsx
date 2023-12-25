import { useState, useEffect } from "react"
import { Link, router } from "@inertiajs/react"
import usePagination from "@/Hooks/usePagination"

export default function Index({ systems }) {

    const [data, loadMoreData] = usePagination(systems, 'systems')

        return (
        <div>
            <ul>
                {data.map(system => <li className='text-xl' key={system.id}>{system.name}</li>)}
            </ul>
            
            {systems.links.next && <button className='border-2 rounded-md p-3 m-auto border-blue-500 text-blue-500 text-4xl' onClick={loadMoreData}>Carregar mais</button>}
        </div>
    )
}