<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion de Agendas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1>Agenda</h1>
                    <table class='table table--lg team-roster-table table-hover'>
                        <thead>
                            <th class='team-roster-table__name'>ID</th>
                            <th class='team-roster-table__name'>Agenda</th>
                            <th class='team-roster-table__name'>Estado</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr v-for="(object, index) in calendar" :key="index">
                                <td class='team-roster-table__number'>{{ object.id }}</td>
                                <td class='team-roster-table__name'>{{ object.schedule }}</td>
                                <td class='team-roster-table__name'>{{ object.state }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome
        },
        props: ['calendar'],
    })
</script>
