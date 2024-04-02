import { useForm } from "@inertiajs/react"

export default function Create() {

    const { data, setData, post, processing, errors } = useForm({
        name: '',
        genre: '',
    })

    const submit = (e) => {
        e.preventDefault()

        post(route('admin.system.store'))
    }

    return (
        <main>
            <form onSubmit={submit}>
                
            </form>
        </main>
    )
}