<template>
    <div class="form-group mb-2">
        <label :class="{'is-invalid': error != null}" :for="`${name}Input`">{{title}}</label>
        <input
            class="form-control"
            v-if="type !== 'textarea'"
            :class="{'is-invalid': error != null}"
            :type="`${type}`"
            :id="`${name}Input`"
            :name="`${name}`"
            :placeholder="`${placeholder}`"
            :value="value"
            @input="handleOutput"
        >
        <textarea
            class="form-control"
            rows="4"
            v-else-if="type === 'textarea'"
            :class="{'is-invalid': error != null}"
            :name="`${name}`"
            :id="`${name}Input`"
            :placeholder="`${placeholder}`"
            :value="value"
            @input="handleOutput"
        ></textarea>
        <span v-if="error != null" class="is-invalid">{{error}}</span>
    </div>
</template>

<script>
    export default {
        name: "FormInput",
        props: {
            type: null,
            name: null,
            title: null,
            placeholder: null,
            error: null,
            value: null
        },
        methods: {
            handleOutput(e) {
                this.$emit('input', e.target.value)
            }
        }
    }
</script>

<style scoped>

</style>
