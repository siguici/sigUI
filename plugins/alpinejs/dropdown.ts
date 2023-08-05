export default (status = false) => ({
    status,

    trigger: {
        ["x-ref"]: "trigger",
        ["@click"]() {
            this.enable();
        },
    },

    target: {
        ["x-show"]() {
            return this.status;
        },
        ["@click.outside"]() {
            this.disable();
        },
        ["@keydown.escape.window"]() {
            this.disable();
        },
    },

    up: {
        ["x-show"]() {
            return this.status;
        },
    },

    down: {
        ["x-show"]() {
            return !this.status;
        },
    },

    enable() {
        this.status = true;
    },

    disable() {
        this.status = false;
    },

    toogle() {
        this.status ? this.disable() : this.enable();
    },
});
