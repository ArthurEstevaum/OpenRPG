import useLoadMore from "@/Hooks/useLoadMore"
import useSearchFilter from "@/Hooks/useSearchFilter"
import useDidUpdateEffect from "@/Hooks/useDidUpdateEffect"

export default function Index({ scenarios }) {

    const [loadedData, loadMore, setLoadedData] = useLoadMore(scenarios, 'scenarios')
    const [searchedData, debouncedSearch] = useSearchFilter(scenarios, 'scenarios')

    //Keeps loaded data synchronized with searched data
    useDidUpdateEffect(() => {
        setLoadedData([...searchedData])
    }, [searchedData])

    return (
        <div>
            <input type="search" placeholder="Pesquise por nome ou gênero..." 
            onChange={debouncedSearch} />

            {loadedData.length == 0 && <p>Nenhum cenário encontrado.</p>}
            
            <ul>
                {loadedData.map(scenario => 
                    <li className='text-xl' key={scenario.id}>{scenario.name} - {scenario.system.name}</li>)}
            </ul>
            
            {scenarios.links.next && <button onClick={loadMore} 
            className='border-2 rounded-md p-3 m-auto border-blue-500 text-blue-500 text-4xl'>Carregar mais</button>}
        </div>
    )
}