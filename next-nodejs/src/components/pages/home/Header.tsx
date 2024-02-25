"use client";

import { Button } from "@/components/ui/buttons";
import { Input } from "@/components/ui/inputs";
import { useAuth } from "@/stores/auth";
import { deleteCookie, getCookie } from "cookies-next";
import Image from "next/image";
import { useCallback } from "react";
import { IoSearch } from "react-icons/io5";

export const Logo = () => {
  return (
    <div className="h-7">
      <Image
        src="/logo.png"
        width={168}
        height={28}
        alt="Logo"
        className="h-full"
      />
    </div>
  );
};

const SearchInput = () => {
  return (
    <div className="w-full">
      <Input
        placeholder="Cari parfum kesukaanmu"
        wrapperClassName="w-full"
        inputClassName="bg-gray-100 !border-gray-100"
        icon={<IoSearch className="text-xl" />}
      />
    </div>
  );
};

const Buttons = () => {
  const user = useAuth((state: any) => state.user);
  const logUserOut = useAuth((state: any) => state.logUserOut);

  const logout = useCallback(() => {
    const token = getCookie("token");

    fetch(`${process.env.NEXT_PUBLIC_API_URL}/logout`, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
    })
      .then((res) => res.json())
      .then((body) => {
        if (body.code === 200) {
          logUserOut(body.data);
        }

        deleteCookie("token");

        window.location.href = "/";
      })
      .catch((e) => {
        deleteCookie("token");

        window.location.href = "/";
      });
  }, []);

  return (
    <div className="flex items-center justify-end">
      {user ? (
        <>
          <div className="mr-2">
            Hi, {user.full_name}
            <br />
            Your role is <strong>{user.role}</strong>
          </div>

          <div className="mr-2 w-[84px]">
            <Button label="LOGOUT" className="!w-full" onClick={logout} />
          </div>
        </>
      ) : (
        <>
          <div className="mr-2 w-[84px]">
            <Button
              label="MASUK"
              color="primary-inverse"
              className="!w-full"
              link="/login"
            />
          </div>

          <div className="mr-2 w-[84px]">
            <Button
              label="DAFTAR"
              className="!w-full"
              link="/login?register=true"
            />
          </div>
        </>
      )}
    </div>
  );
};

export const Header = () => {
  return (
    <header className="border-b mb-16">
      <div className="container mx-auto px-4">
        <div className="py-5 flex items-center">
          <div className="w-1/4">
            <Logo />
          </div>

          <div className="w-2/4 flex items-center justify-center px-8">
            <SearchInput />
          </div>

          <div className="w-1/4">
            <Buttons />
          </div>
        </div>
      </div>
    </header>
  );
};
