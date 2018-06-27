<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Todo List</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">New Todo</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="type new todo"
                                               v-model="textTodo">
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" v-on:click="addTodo()">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <td><a href="#" class="btn btn-sm btn-danger"
                                       v-on:click="deleteTodo(todo.id)">Delete</a></td>
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
                todoList: [],
                textTodo: '',
            }
        },
        mounted() {
            this.getTodo()
        },
        methods: {
            getTodo: function () {
                var app = this;
                axios.get('http://127.0.0.1:8001/todos/all')
                    .then(function (response) {
                        app.todoList = response.data;
                    })
                    .catch(function (error) {
                        alert(error);
                    });
            },
            deleteTodo: function (id) {
                var app = this;
                axios.post('http://127.0.0.1:8001/todos/delete/' + id)
                    .then(function (response) {
                        app.getTodo();
                    })
                    .catch(function (error) {
                        alert(error);
                    })
            },
            addTodo: function () {
                var app = this;
                axios.post('http://127.0.0.1:8001/todos/add', {
                        'todo': app.textTodo
                    })
                    .then(function (response) {
                        app.getTodo();
                    })
                    .catch(function (error) {
                        alert(error);
                    });
            }
        }
    }
</script>
