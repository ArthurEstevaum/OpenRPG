import usePagination from "@/Hooks/usePagination"
import useSearchPagination from "@/Hooks/useSearchPagination"
import { router } from "@inertiajs/react"
import debounce from "lodash.debounce"
import { useState, useMemo, useEffect } from "react"
import useLoadMore from "@/Hooks/useLoadMore"


export default function Index({ systems }) {

    /*const [data, loadMoreData, setShouldUpdateData] = usePagination(systems, 'systems')
    const [search, setSearch] = useState('')

    const debouncedSearch = useMemo(() => {
        return debounce((e) => {
            if(e.target.value == '') {
                //when the user searchs, then exclude all
                //characters, the page reload the complete pagination
                router.get(systems.meta.path, {}, {preserveScroll: true, 
                    preserveState:true,
                    only: ['systems']})
            } 
            setSearch(() => e.target.value)
            setShouldUpdateData(false)
        }, 500)
    }, [])

    useEffect(() => {
        if(search !== '') {
            router.get(systems.meta.path, {search}, {only:['systems'], preserveScroll: true, preserveState: true})
        }
    }, [search])

    useEffect(() => {
        return () => {
            debouncedSearch.cancel()
        }
    })*/
    //const [data, loadMoreData, search] = useSearchPagination(systems, 'systems')
    /**
     * new hooks
     */
    const [dataDisplayed, setDataDisplayed] = useState([]);
    const [search, setSearch] = useState("");
    const [selectedOption, setSelectedOption] = useState("")
    const filteredData = useFilter(systems, 'systems', search, selectedOption)
    const [fetchedData, loadMoreData] = useLoadMore(systems, 'systems')

    const debouncedSearch = useMemo(() => {
        return debounce((e) => {
            if(e.target.value == '') {
                //when the user searchs, then exclude all
                //characters, the page reload the complete pagination
                router.get(urlBasePath, {}, {preserveScroll: true, 
                    preserveState: true,
                    replace: true,
                    only: [sourceName],
                })
            }    
            setSearch(() => e.target.value)
        }, 500)
    }, [])

    useEffect(() => {
        console.log([...fetchedData, ...filteredData]);
    }, [fetchedData, filteredData])
    
        return (
        <div>
            <input type="search" placeholder="Digite aqui para pesquisar..." onChange={debouncedSearch} />
            {data.length == 0 && <p>Nenhum sistema encontrado.</p>}

            <select name="genre-filter" id="genre-filter" value={selectedOption}
            onChange={(e) => setSelectedOption(e.target.value)}>
                <option value="">Selecionar</option>
                <option value="Medieval fantasy">Fantasia Medieval</option>
                <option value="Dark Fantasy">Mistério/Horror</option>
                <option value="Sci-fi">Fantasia Científica/Futurística</option>
                <option value="Steampunk">Steampunk</option>
            </select>
            

            <ul>
                {data.map(system => <li className='text-xl' key={system.id}>{system.name}</li>)}
            </ul>
            
            {systems.links.next && <button className='border-2 rounded-md p-3 m-auto border-blue-500 text-blue-500 text-4xl' onClick={loadMoreData}>Carregar mais</button>}
        </div>
    )
}