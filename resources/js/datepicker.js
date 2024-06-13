import AirDatepicker from "air-datepicker";
import "air-datepicker/air-datepicker.css";
import localeEn from "air-datepicker/locale/en";

var tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);

new AirDatepicker("#air-datepicker", {
    minView: "months",
    minDate: tomorrow,
    maxDate: new Date("2025-01-01T00:00:00"),
    locale: localeEn,
    onRenderCell: ({ date }) => {
        if (date.getDay() === 0 || date.getDay() === 6) {
            return {
                disabled: true,
            };
        }
    },
});
