const Title = ({ text, style = {}, className = "" }) => {
  const defaultStyles = {
    textAlign: "center",
    fontSize: "1.25rem",
    fontWeight: "600",
    marginBottom: "20px",
    color: "#333",
  };

  return (
    <h2 style={{ ...defaultStyles, ...style }} className={className}>
      {text}
    </h2>
  );
};

export default Title;
