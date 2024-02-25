import React, { ReactNode } from "react";

export interface InputProps {
  value?: string | number;
  onChange?: (event: any) => any;
  placeholder?: string;
  inputClassName?: any;
  wrapperClassName?: any;
  icon?: ReactNode;
  type?: "text" | "password";
}

export const Input = (props: InputProps) => {
  return (
    <div className={`relative ${props.wrapperClassName}`}>
      <div className="w-full">
        <input
          type={props.type || "text"}
          value={props.value}
          onChange={props.onChange}
          placeholder={props.placeholder}
          className={`w-full rounded-none border border-gray-300 focus:!border-primary-500 outline-none px-4 py-2 text-sm transition-colors ${
            props.inputClassName
          } ${props.icon && "pr-10"}`}
        />
      </div>
      <div className="absolute top-0 right-0 h-full w-10 flex items-center justify-center text-gray-500">
        {props.icon}
      </div>
    </div>
  );
};
