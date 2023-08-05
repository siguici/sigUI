export default (status = false) => ({
    status,

    on: {
        ["x-ref"]: "on",
        ["x-show"]() {
            return !this.status;
        },
        ["@click"]() {
            this.enable();
        },
    },

    off: {
        ["x-ref"]: "off",
        ["x-show"]() {
            return this.status;
        },
        ["@click"]() {
            this.disable();
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
