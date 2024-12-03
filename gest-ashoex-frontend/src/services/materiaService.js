const BASE_URL = "http://localhost:8000/api/materias";

export const createMateria = async (materiaData) => {
  try {
    const response = await fetch(BASE_URL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(materiaData),
    });

    const result = await response.json();
    return result;
  } catch (error) {
    return error;
  }
};
