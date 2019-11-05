<template>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Ooopps!</strong> {{ message }}
        <button @click="close" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
    export default {
        name: "ErrorMessage",
        props: [
            'message',
        ],
        methods: {
            close() {
                this.$emit('close-error')
            }
        }
    }
</script>
