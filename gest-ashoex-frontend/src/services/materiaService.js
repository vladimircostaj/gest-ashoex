const API_URL = "http://127.0.0.1:8000"; 

const fetchMaterias = async () => {
  const response = await fetch(`${API_URL}/api/materias`, 
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  ); 
  const data = await response.json(); 
  
  return data;
};

const materiaService = {
  fetchMaterias,
};

export default materiaService;

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
