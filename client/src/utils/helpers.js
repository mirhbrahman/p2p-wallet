import { toast } from "react-toastify";

export const toastMessage = (msg, type = 'success') => {
    const config = {
        position: "top-right",
        autoClose: 3000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: true,
        draggable: true,
        progress: undefined,
    };

    if (type === 'success') {
        toast.success(msg, config);
    }
}

export const capitalize = (str) => {
    return str ? str.charAt(0).toUpperCase() + str.slice(1) : str;
};
