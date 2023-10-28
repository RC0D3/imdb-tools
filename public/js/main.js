var app = new Vue({
    el: '#root',
    data: {
        showGeneratedCommand: false,
        showCopied: false,
        outAnimation: false,

        loading: false,

        url: "",
        info: {
            title: '',
            rating: '',
            genres: '',

            year: '',
            rated: '',

        },
        next: '',
        startTime: '00:00',

        errorMessage: '',
        showError: false,
    },
    mounted() {
        this.$refs.clipboard.classList.toggle('hidden');
        this.$refs.loading.classList.toggle('hidden');
    },

    methods: {
        copyDoubleClick() {
            navigator.clipboard.writeText(this.$refs.clipboard.innerText).then(function () {
                app._data.showCopied = true
                setTimeout(() => {
                    app._data.showCopied = false
                    app._data.outAnimation = false
                }, 1200)
                setTimeout(() => {
                    app._data.outAnimation = true
                }, 1000)

            }, function (err) {
                alert('Usando navegador véio tio(a)?')
            })

        },

        generateCommand() {
            this.showGeneratedCommand = false
            this.loading = true
            axios.post('/api/info', {
                url: this.url
            }).then(response => {
                this.info = response.data.data
                this.loading = false
                this.showGeneratedCommand = !this.showGeneratedCommand
            })
                .catch(error => {
                    this.errorMessage = error.response.data.error
                    this.loading = false
                    this.showError = true
                    this.showGeneratedCommand = !this.showGeneratedCommand
                    setTimeout(() => {
                        this.showGeneratedCommand = !this.showGeneratedCommand
                        this.showError = false
                        this.errorMessage = ''
                    }, 1200)
                })
        },
    },
})
