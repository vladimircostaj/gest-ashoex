import React from "react";

const InputField = ({
  label,
  id,
  type = "text",
  placeholder,
  value,
  onChange,
  style = {},
  error = "",
}) => {
  const defaultStyles = {
    container: {
      display: "flex",
      flexDirection: "column",
      gap: "5px",
    },
    label: {
      fontSize: "14px",
      fontWeight: "500",
      color: "#555",
    },
    input: {
      width: "100%",
      padding: "10px",
      borderRadius: "8px",
      border: "1px solid #ccc",
      fontSize: "14px",
    },
    errorInput: {
      border: "1px solid red", // Estilo de borde para indicar error
    },
    errorMessage: {
      fontSize: "12px",
      color: "red",
      marginTop: "5px",
    },
  };

  return (
    <div className="mb-4">
    <div style={{ ...defaultStyles.container, ...style.container }}>
      <label htmlFor={id} style={{ ...defaultStyles.label, ...style.label }}>
        {label}
      </label>
      <input
        id={id}
        type={type}
        placeholder={placeholder}
        style={{
          ...defaultStyles.input,
          ...(error ? defaultStyles.errorInput : {}),
          ...style.input,
        }}
        value={value}
        onChange={onChange}
      />
      {error && <div style={defaultStyles.errorMessage}>{error}</div>}
    </div>
    </div>
  );
};

export default InputField;