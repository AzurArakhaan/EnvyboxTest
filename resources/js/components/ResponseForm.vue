<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h3>Форма обратной связи</h3>
                <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis facere, fugit illum in magnam officia omnis praesentium quae quisquam voluptatum! Adipisci architecto, autem dignissimos eos excepturi inventore sed sequi sunt.</p>
                <form class="w-100" @submit.prevent="sendForm">
                    <form-input title="Имя" name="name" type="input" placeholder="Имя" :error="getError('name')" v-model:inputValue="name"></form-input>

                    <form-input title="Телефон" name="phone" type="tel" placeholder="Телефон" :error="getError('phone')" v-model:inputValue="phone"></form-input>

                    <form-input title="Сообщение" name="message" type="textarea" placeholder="Сообщение" :error="getError('message')" v-model:inputValue="message"></form-input>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary w-100" value="Отправить">
                    </div>
                    <span v-if="showSuccess">Отправка успешна!</span>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "response-form",
        data() {
            return {
                name: null,
                phone: null,
                message: null,
                showSuccess: false,
                errors: [],
            }
        },
        watch: {
            name(value) {
                if (value != null) {
                    delete this.errors.name;
                }
            },
            phone(value) {
                if (value != null) {
                    delete this.errors.phone;
                }
            },
            message(value) {
                if (value != null) {
                    delete this.errors.message;
                }
            }
        },
        methods: {
            sendForm()
            {
                axios.post('/api/saveApplication', {
                    name: this.name,
                    phone: this.phone,
                    message: this.message
                }).then(response => {
                    this.name = null;
                    this.phone = null;
                    this.message = null;
                    this.showSuccess = true;

                }).catch(error => {
                    this.errors = error.response.data.message;
                    this.showSuccess = false;
                })
            },
            errorExits(name)
            {
                return typeof this.errors[name] !== "undefined";
            },
            getError(name)
            {
                if (this.errorExits(name)) {
                    return this.errors[name][0];
                }

                return null;
            }
        }
    }
</script>

<style scoped>

</style>
