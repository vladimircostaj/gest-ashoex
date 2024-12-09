export const getPersonalById = async (id) => {
    const response = await fetch(
      `http://localhost:8000/api/personal-academicos/${id}`
    );
    return await response.json();
  };
