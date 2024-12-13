const BASE_URL = "http://127.0.0.1:8000/api";

export const getAllCurriculas = async () => {
    try {
        const response = await fetch(`${BASE_URL}/curriculas`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        });
        const data = await response.json();

        return data;
    } catch (error) {
        return error;
    }
};

export const deleteCurricula = async (curriculaId) => {
    try {
        const response = await fetch(`${BASE_URL}/curriculas/${curriculaId}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
        });
        const data = await response.json();

        return data;
    } catch (error) {
        return error;
    }
};