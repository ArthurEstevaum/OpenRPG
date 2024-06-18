import AdminLayout from "@/Layouts/AdminLayout";
import { Head, Link } from "@inertiajs/react";

export default function Dashboard({ auth }) {
    return (
        <AdminLayout user={auth.user}>
            <Head title="Admin Dashboard" />
            <main className="w-4/5 sm:w-9/12 lg:w-4/12 m-auto mt-10 bg-white p-5 rounded-lg text-center shadow-md">
                <Link
                    className="block border-2 rounded-md p-1 m-auto border-blue-500 text-blue-500 text-base my-4 hover:bg-blue-500 hover:text-gray-50 transition ease-in-out duration-300"
                    href={route("admin.system.index")}
                >
                    Sistemas de jogo
                </Link>
                <Link
                    className="block border-2 rounded-md p-1 m-auto border-blue-500 text-blue-500 text-base my-4 hover:bg-blue-500 hover:text-gray-50 transition ease-in-out duration-300"
                    href={route("admin.scenario.index")}
                >
                    Cenários de jogo
                </Link>
            </main>
        </AdminLayout>
    );
}
