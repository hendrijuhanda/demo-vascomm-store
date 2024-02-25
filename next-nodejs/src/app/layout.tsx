"use client";

import "./globals.css";
import { roboto } from "@/components/ui/fonts";
import { useAuth } from "@/stores/auth";
import { deleteCookie, getCookie } from "cookies-next";
import { useEffect, useState } from "react";

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  const [isReady, setIsready] = useState<boolean>(false);
  const logUserIn = useAuth((state: any) => state.logUserIn);

  useEffect(() => {
    const token = getCookie("token");

    if (token) {
      fetch(`${process.env.NEXT_PUBLIC_API_URL}/authenticate`, {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
      })
        .then((res) => res.json())
        .then((body) => {
          if (body.code === 200) {
            logUserIn(body.data);
          }

          setIsready(true);
        })
        .catch((e) => {
          deleteCookie("token");

          setIsready(true);
        });
    } else {
      setIsready(true);
    }
  }, []);

  return (
    <html lang="id">
      <body className={roboto.className}>{isReady && children}</body>
    </html>
  );
}
