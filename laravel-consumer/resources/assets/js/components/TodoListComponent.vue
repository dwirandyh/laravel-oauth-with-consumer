<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Todo List</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Todo</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="todo in todoList">
                                <td>{{ todo.id }}</td>
                                <td>{{ todo.todo }}</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                todoList: []
            }
        },
        mounted() {
            this.getTodo()
        },
        methods: {
            getTodo: function () {
                alert('todo');
                var app = this;
                axios.get('http://127.0.0.1:8001/api/todo')
                    .then(function (response) {
                        app.todoList = response.data;
                        alert(response);
                    })
                    .catch(function (error) {
                        alert(error);
                    });
            }
        }
    }
</script>
