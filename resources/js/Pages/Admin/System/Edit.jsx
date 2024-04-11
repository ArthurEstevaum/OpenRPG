import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react"

export default function Edit({ system, auth }) {
    return (
        <AuthenticatedLayout user={auth.user} >
            <Head title="Editar sistema" />
        </AuthenticatedLayout>
    )
}