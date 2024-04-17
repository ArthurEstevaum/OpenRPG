import InputSuccess from "@/Components/InputSuccess";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage } from "@inertiajs/react"

export default function Edit({ system, auth }) {

    const { flash } = usePage().props

    return (
        <AuthenticatedLayout user={auth.user} >
            <Head title="Editar cenário" />
            
            <InputSuccess message={flash.success} />

            
        </AuthenticatedLayout>
    )
}