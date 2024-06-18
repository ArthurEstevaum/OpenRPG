import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout"
import { Head } from "@inertiajs/react"

export default function Show({ scenario, auth }) {

    const createdAt = new Date(scenario.created_at);
    const updatedAt = new Date(scenario.updated_at);

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={scenario.name} />
            <main className='text-center mt-10'>
                <h1 className='text-3xl'>{scenario.name}</h1>
                <h2 className='text-xl'>Sistema - {scenario.system.name}</h2>
                <h2 className='text-xl'>Gênero - {scenario.system.genre}</h2>
                <p>Criado em: {createdAt.toLocaleDateString()} - Atualizado em: {updatedAt.toLocaleDateString()}</p>
            </main>
        </AuthenticatedLayout>
    )
}