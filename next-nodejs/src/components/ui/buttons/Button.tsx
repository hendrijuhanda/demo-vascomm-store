import Link from "next/link";

export interface ButtonProps {
  label?: string;
  color?: "primary" | "primary-inverse";
  link?: string;
  className?: string;
  onClick?: () => void;
}

export const Button = (props: ButtonProps) => {
  const color = props.color || "primary";

  let colorClassName = "";

  switch (color) {
    case "primary":
      colorClassName =
        "bg-primary-500 text-white hover:bg-primary-600 border border-primary-500";
      break;
    case "primary-inverse":
      colorClassName =
        "bg-white text-primary-500 border border-primary-500 hover:bg-primary-100";
      break;
  }

  const baseClassName = `text-center inline-block px-4 py-2 tracking-wide transitions-colors ${props.className}`;

  return props.link ? (
    <Link href={props.link} className={`${baseClassName} ${colorClassName}`}>
      {props.label}
    </Link>
  ) : (
    <button
      type="button"
      className={`${baseClassName} ${colorClassName}`}
      onClick={props.onClick}
    >
      {props.label}
    </button>
  );
};
