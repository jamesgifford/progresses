<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Goal Create</div>

                    <div class="card-body">
                        <form method="post" @submit.prevent="createGoal">
                            <input type="text" name="" value="" v-model="goal.name">
                            <input type="text" name="" value="" v-model="goal.target">
                            <button type="submit" name="button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                goal: {}
            }
        },

        created() {
        },

        mounted() {
            console.log('Create Goal component mounted.');
        },

        updated() {
        },

        methods: {
            createGoal: function () {
                axios.post('/api/goals', this.goal).then(response => {
                    console.log("SENT!");
                    this.$root.$emit('goal-created', response.data.goal);
                });
            }
        }
    }
</script>
