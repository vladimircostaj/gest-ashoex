 // URL de API de prueba, remplazar por la URL de la API real
const API_URL = 'http://127.0.0.1:8000/api/';

export const registrarPersonal = async (formData) => {
  try {
    const response = await fetch(`${API_URL}/registrar-personal-academico`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData),
    });

    if (!response.ok) {
      throw new Error('Error en la solicitud');
    }

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error registrando personal:', error);
    throw error;
  }
};