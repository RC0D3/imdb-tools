var app = new Vue({
    el: '#root',
    data: {
        showGeneratedCommand: false,
        doubleClickTimeout: null,
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

    methods: {
        copyDoubleClick() {
            if (!this.doubleClickTimeout) {
                this.doubleClickTimeout = setTimeout(() => {}, 50)
            } else {
                clearTimeout(this.doubleClickTimeout)
                doubleClickTimeout = null

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
            }
        },

        generateCommand() {
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
        }
    },
})
