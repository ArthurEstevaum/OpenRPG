import useLoadMore from "@/Hooks/useLoadMore";
import useSearchFilter from "@/Hooks/useSearchFilter";
import useDidUpdateEffect from "@/Hooks/useDidUpdateEffect";
import AdminLayout from "@/Layouts/AdminLayout";
import { Head, Link, usePage } from "@inertiajs/react";
import InputSuccess from "@/Components/InputSuccess";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Index({ scenarios, auth }) {
    const { flash } = usePage().props;

    const [loadedData, loadMore, setLoadedData] = useLoadMore(
        scenarios,
        "scenarios"
    );
    const [searchedData, debouncedSearch] = useSearchFilter(scenarios, "scenarios");

    //Keeps loaded data synchronized with searched data
    useDidUpdateEffect(() => {
        setLoadedData([...searchedData]);
    }, [searchedData]);

    return (
        <AdminLayout user={auth.user}>
            <Head title="Cenários de jogo" />
            <div className="relative overflow-x-auto shadow-md sm:rounded-lg m-auto w-full md:w-11/12 mt-5">
                <div className="pb-4 bg-white dark:bg-gray-900 p-10 flex justify-between ">
                    <InputSuccess message={flash.success} className="mb-4" />
                    <label htmlFor="table-search" className="sr-only">
                        Pesquisar
                    </label>
                    <div className="relative mt-1">
                        <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg
                                className="w-4 h-4 text-gray-500 dark:text-gray-400"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    stroke="currentColor"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                />
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="table-search"
                            onChange={debouncedSearch}
                            className="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Procurar cenários"
                        />
                    </div>
                    <Link href={route('admin.scenario.create')}>
                        <PrimaryButton className="bg-green-600 px-4">
                            Criar +
                        </PrimaryButton>
                    </Link>
                </div>
                {loadedData.length !== 0 && (
                    <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" className="px-6 py-3">
                                    Nome
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Sistema
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {loadedData.map((scenario) => (
                                <tr
                                    className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                    key={scenario.id}
                                >
                                    <th
                                        scope="row"
                                        className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        <Link
                                            href={route(
                                                "admin.scenario.show",
                                                scenario.id
                                            )}
                                            className="hover:underline"
                                        >
                                            {scenario.name}
                                        </Link>
                                    </th>
                                    <td className="px-6 py-4">
                                        {scenario.system.name}
                                    </td>
                                    <td className="px-6 py-4 space-x-4">
                                        <Link
                                            href={route(
                                                "admin.scenario.edit",
                                                scenario.id
                                            )}
                                            className="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                        >
                                            Editar
                                        </Link>
                                        <Link
                                            href={route(
                                                "admin.scenario.delete",
                                                scenario.id
                                            )}
                                            className="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        >
                                            Remover
                                        </Link>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                )}
                {loadedData.length == 0 && (
                    <p className="p-10">Nenhum sistema encontrado.</p>
                )}
                <div className="flex justify-center border-top bg-white">
                    {scenarios.links.next && (
                        <button
                            onClick={loadMore}
                            className="border-2 rounded-md p-1 m-auto border-blue-500 text-blue-500 text-base my-4 hover:bg-blue-500 hover:text-gray-50 transition ease-in-out duration-300"
                        >
                            Carregar mais
                        </button>
                    )}
                </div>
            </div>
        </AdminLayout>
    );
}
