import useLoadMore from '@/Hooks/useLoadMore'
import useSearchFilter from '@/Hooks/useSearchFilter'
import useDidUpdateEffect from '@/Hooks/useDidUpdateEffect'


export default function Index({ systems }) {

    const [loadedData, loadMore, setLoadedData] = useLoadMore(systems, 'systems')
    const [searchedData, debouncedSearch] = useSearchFilter(systems, 'systems')

    //Keeps loaded data synchronized with searched data
    useDidUpdateEffect(() => {
        setLoadedData([...searchedData])
    }, [searchedData])

    return (
        <div>
            <input type="search" placeholder="Pesquise por nome ou gênero..." 
            onChange={debouncedSearch} />

            {loadedData.length == 0 && <p>Nenhum sistema encontrado.</p>}
            
            <ul>
                {loadedData.map(system => 
                    <li className='text-xl' key={system.id}>{system.name} - {system.genre}</li>)}
            </ul>
            
            {systems.links.next && <button onClick={loadMore} 
            className='border-2 rounded-md p-3 m-auto border-blue-500 text-blue-500 text-4xl'>Carregar mais</button>}
        </div>
    )
}