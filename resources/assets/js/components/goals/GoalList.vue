<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Goal List</div>

                    <div class="card-body">
                        <ul>
                            <li v-for="goal in goals">
                                <p><a :href="'/home/goal/' + goal.id">{{ goal.name }}</a></p>
                                <div class="graph">
                                    <ul :id="goal.id" class="squares"></ul>
                                </div>
                            </li>
                        </ul>
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
                'goals': []
            }
        },

        created() {
            axios.get('/api/goals').then(response => {
                this.goals = response.data.goals;
                console.log('AXIOS!!!');
            });
        },

        mounted() {
            console.log('Goals component mounted.');

            this.$root.$on('goal-created', (goal) => {
                console.log("CAUGHT THE EVENT");
                this.goals.unshift(goal);
            });
        },

        updated() {
            // Populate the history chart
            $.each(this.goals, function( i, goal ) {
                $('#'+goal.id).empty();
                $.each(goal.history, function (j, amount) { 
                    $('#'+goal.id).append('<li data-level="'+amount+'"></li>');
                });
            });
        }
    }
</script>
