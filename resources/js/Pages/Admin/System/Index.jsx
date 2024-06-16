import useLoadMore from '@/Hooks/useLoadMore'
import useSearchFilter from '@/Hooks/useSearchFilter'
import useDidUpdateEffect from '@/Hooks/useDidUpdateEffect'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout"
import { usePage } from "@inertiajs/react"
import InputSuccess from "@/Components/InputSuccess"


export default function Index({ systems, auth }) {

    const { flash } = usePage().props

    const [loadedData, loadMore, setLoadedData] = useLoadMore(systems, 'systems')
    const [searchedData, debouncedSearch] = useSearchFilter(systems, 'systems')

    //Keeps loaded data synchronized with searched data
    useDidUpdateEffect(() => {
        setLoadedData([...searchedData])
    }, [searchedData])

    return (
        <AuthenticatedLayout user={auth.user}>
            <main className="w-4/5 sm:w-3/5 lg:w-2/5 mt-10">
                <InputSuccess message={flash.success} />
                <input className="mb-6" type="search" placeholder="Pesquise por nome ou gênero..."
                onChange={debouncedSearch} />
                {loadedData.length == 0 && <p>Nenhum sistema encontrado.</p>}
            
                <ul className="space-y-2">
                    {loadedData.map(system =>
                        <li className='text-xl' key={system.id}>{system.name} - {system.genre}</li>)}
                </ul>
            
                {systems.links.next && <button onClick={loadMore}
                className='border-2 rounded-md p-1 m-auto border-blue-500 text-blue-500 text-lg my-6'>Carregar mais</button>}
            </main>
        </AuthenticatedLayout>
    )
}