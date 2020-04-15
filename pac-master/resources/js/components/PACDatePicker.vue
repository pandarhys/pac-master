<template>
    <div id="DatePicker">
        <h3 class="mb-2">
            <slot name="DateHeader"></slot>
        </h3>
        <p class="mb-1">
            <slot name="DateDescription"></slot>
        </p>
        <datepicker v-model="vModelDate"></datepicker>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    const state = {
        date1: new Date()
    };

    export default {
        components: {
            Datepicker
        },
    data() {
        return {
            format: "d MMMM yyyy",
            disabledDates: {},
            disabledFn: {
                customPredictor(date) {
                    if (date.getDate() % 3 === 0) {
                        return true;
                    }
                }
            },
            highlightedFn: {
                customPredictor(date) {
                    if (date.getDate() % 4 === 0) {
                        return true;
                    }
                }
            },
            highlighted: {},
            eventMsg: null,
            state: state,
            language: "en",
            languages: lang,
            vModelDate: null,
            changedMonthLog: []
        };
    },
    methods: {
        highlightTo(val) {
            if (typeof this.highlighted.to === "undefined") {
                this.highlighted = {
                    to: null,
                    daysOfMonth: this.highlighted.daysOfMonth,
                    from: this.highlighted.from
                };
            }
            this.highlighted.to = val;
        },
        highlightFrom(val) {
            if (typeof this.highlighted.from === "undefined") {
                this.highlighted = {
                    to: this.highlighted.to,
                    daysOfMonth: this.highlighted.daysOfMonth,
                    from: null
                };
            }
            this.highlighted.from = val;
        },
        setHighlightedDays(elem) {
            if (elem.target.value === "undefined") {
                return;
            }
            let highlightedDays = elem.target.value
                .split(",")
                .map(day => parseInt(day));
            this.highlighted = {
                from: this.highlighted.from,
                to: this.highlighted.to,
                daysOfMonth: highlightedDays
            };
        },
        setDisabledDays(elem) {
            if (elem.target.value === "undefined") {
                return;
            }
            let disabledDays = elem.target.value.split(",").map(day => parseInt(day));
            this.disabledDates = {
                from: this.disabledDates.from,
                to: this.disabledDates.to,
                daysOfMonth: disabledDays
            };
        },
        disableTo(val) {
            if (typeof this.disabled.to === "undefined") {
                this.disabledDates = {
                    to: null,
                    daysOfMonth: this.disabledDates.daysOfMonth,
                    from: this.disabled.from
                };
            }
            this.disabledDates.to = val;
        },
        disableFrom(val) {
            if (typeof this.disabledDates.from === "undefined") {
                this.disabled = {
                    to: this.disabledDates.to,
                    daysOfMonth: this.disabled.daysOfMonth,
                    from: null
                };
            }
            this.disabledDates.from = val;
        },
        openPicker() {
            this.$refs.programaticOpen.showCalendar();
        },
        logChangedMonth(date) {
            this.changedMonthLog.push(date)
        }
    }
};
</script>

<style>
body {
    font-family: "Helvetica Neue Light", Helvetica, sans-serif;
    padding: 1em 2em 2em;
}
input,
select {
    padding: 0.75em 0.5em;
    font-size: 100%;
    border: 1px solid #ccc;
    width: 100%;
}

select {
    height: 2.5em;
}

.example {
    background: #f2f2f2;
    border: 1px solid #ddd;
    padding: 0em 1em 1em;
    margin-bottom: 2em;
}

code,
pre {
    margin: 1em 0;
    padding: 1em;
    border: 1px solid #bbb;
    display: block;
    background: #ddd;
    border-radius: 3px;
}

.settings {
    margin: 2em 0;
    border-top: 1px solid #bbb;
    background: #eee;
}

h5 {
    font-size: 100%;
    padding: 0;
}

.form-group {
    margin-bottom: 1em;
}

.form-group label {
    font-size: 80%;
    display: block;
}
</style>
