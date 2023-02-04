import { extend } from "vee-validate";
import {
    required,
    email,
    min,
    confirmed,
    regex,
    mimes,
    numeric
} from "vee-validate/dist/rules";

extend("required", {
    ...required,
    message: "این فیلد نمیتواند خالی باشد",
});
extend("numeric", {
    ...numeric,
    message: "لطفا عدد وارد نمایید",
});
extend("mimes", {
    ...mimes,
    message: "فرمت باید jpeg,jpg,png,gif باشد",
});

extend("min", {
    ...min,
    message: "این فیلد باید حداقل دارای {length} حرف باشد",
});

extend("regex", {
    ...regex,
    message: "فرمت و قالب موبایل را درست وارد نمایید",
});

extend("email", {
    ...email,
    message: "فرمت و قالب ایمیل را درست وارد کنید ،ایمیل نباید تکراری باشد",
});

extend("confirmed", {
    ...confirmed,
    message: "تایید پسورد و پسورد باهم مطابقت ندارد",
});
