<template>
    <div>

        <div class="p-4">
            <label for="search">Search</label>
            <input id="search" type="text" v-model="myinputbox" v-model="term" @keyup="search" autocomplete="off"
                   class="ml-2 px-2 py-1 text-sm rounded-border">
        </div>

        <table>
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Username
                </th>
                <th>
                    Name
                </th>
            </tr>

            <tr v-for="(user, index) in users.data" :class="{'bg-gray-300':index%2 === 0}">
                <td>
                    {{ user.id }}
                </td>
                <td>
                    {{ user.username }}
                </td>
                <td>
                    {{ user.name }}
                </td>

            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "SearchFilter",


    data() {
        return {
            term: '',

        }
    },
    props: {
        users: Object,
    },
    methods: {
        search() {
            this.$inertia.replace(this.$route('users.search'))
        },
        compositionUpdate: function (search) {
            this.term = search.data;
        },
    }
}
</script>

<style scoped>

</style>
