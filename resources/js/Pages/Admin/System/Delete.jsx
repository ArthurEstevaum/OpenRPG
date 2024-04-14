import { Head, usePage } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Delete({ auth, system }) {

    const { flash } = usePage().props

    return (
        <AuthenticatedLayout user={auth.user} >
            <Head title="Excluir sistema de jogo" />
        </AuthenticatedLayout>
    )
}