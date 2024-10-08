// src/services/ActualizarPersonalService.js para la conexion put

export const actualizarPersonal = async (id, personalData) => {
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/personal-academico/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(personalData),
      });
  
      if (!response.ok) {
        throw new Error('Error en la solicitud al actualizar el personal académico.');
      }
  
      const data = await response.json();
      return data;
    } catch (error) {
      throw new Error(error.message);
    }
  };
  