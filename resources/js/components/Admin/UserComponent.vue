<template>
    <div>
            <table class="table table-borderd mb-5">
        <tbody>
            <tr v-for='user in users' :key='user.id'>
                <td>{{user.id}}</td>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>
                    <a :href="`/admin/enterAsUser/${user.id}`">
                        Войти
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <button @click='exportCategories' class="btn btn-link">Выгрузить категории</button>

    <div v-if="processing" class="alert alert-warning mt-4">
        Выгружаем категории
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div v-else-if="exportFinish" class="alert alert-success mt-4">
        Категории выгружены! <a :href='downloadLink'>(Скачать!)</a>
    </div>

    </div>
</template>

<script>
export default {
    props: ['users', 'routeEnterAsUser', 'routeExportCategories'],
    data () {
        return {
            processing: false,
            exportFinish: false,
            downloadLink: null
        }
    },
    methods: {
        exportCategories () {
            this.processing = true
            this.exportFinish = false
            axios.post(this.routeExportCategories)
        }
    },
    mounted () {
        Echo.channel('general')
            .listen('.categories-export-finish', (e) => {
                this.downloadLink = `/storage/${e.message}`
                this.processing = false
                this.exportFinish = true
            });
    },
    destroyed () {
        Echo.channel('general')
            .stopListening('.categories-export-finish')
    }
}
</script>
