import {
  AvailableProducts,
  Banner,
  Footer,
  Header,
  LatestProducts,
} from "@/components/pages/home";

export default function Home() {
  return (
    <>
      <Header />
      <Banner />
      <LatestProducts />
      <AvailableProducts />
      <Footer />
    </>
  );
}
