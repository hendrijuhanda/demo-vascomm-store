import { ReactNode } from "react";

export interface InnerWrapperProps {
  children?: ReactNode;
}

export const InnerWrapper = (props: InnerWrapperProps) => {
  return <div className="container mx-auto px-48">{props.children}</div>;
};
