<template>
    <div>

        <div class="p-4">
            <label for="search">Search</label>
            <input id="search" type="text" @keypress="capturePress"  v-model="term" @keyup="search" autocomplete="off"
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


            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "SearchFilter",


    data() {
        return {
            term: ''
        }
    },
    props: {
        users: Object,
    },
    methods: {
        search() {
            this.$inertia.replace(this.$route('users.search'))
        },

        //in methods
        capturePress(event) {
            console.log(event.charCode);
        }
    }
}
</script>

<style scoped>

</style>
