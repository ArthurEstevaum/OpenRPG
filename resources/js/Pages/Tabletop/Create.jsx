import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function Create({ auth }) {
    return (
        <AuthenticatedLayout user={auth.user} >
            <main>
                <form>
                    <label htmlFor="name">Nome</label>
                    <input type="text" name="name" />
                </form>
            </main>
        </AuthenticatedLayout>
    )
}