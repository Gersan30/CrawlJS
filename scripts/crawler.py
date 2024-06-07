# scripts/crawler.py

import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse
import time
import sys
import logging

# Configurar logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

class WebCrawler:
    def __init__(self, start_url):
        self.start_url = start_url
        self.base_domain = urlparse(start_url).netloc
        self.visited = set()
        self.urls_to_visit = [start_url]
        self.headers = {'User-Agent': 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'}
        self.url_counter = 0  # Contador para el ID incremental

    def is_valid_url(self, url):
        try:
            parsed = urlparse(url)
            return bool(parsed.netloc) and bool(parsed.scheme)
        except Exception as e:
            return False

    def is_internal_url(self, url):
        return urlparse(url).netloc == self.base_domain

    def visit_url(self, url):
        self.url_counter += 1
        logging.info(f"{self.url_counter}: Visitando URL: {url}")
        self.visited.add(url)

        try:
            response = requests.get(url, headers=self.headers)
            response.raise_for_status()
        except requests.RequestException as e:
            logging.error(f"Failed to visit {url}: {e}")
            return

        soup = BeautifulSoup(response.text, 'html.parser')
        for link in soup.find_all('a', href=True):
            href = urljoin(url, link['href'])
            if self.is_valid_url(href) and self.is_internal_url(href) and href not in self.visited:
                self.urls_to_visit.append(href)

    def crawl(self):
        while self.urls_to_visit:
            url = self.urls_to_visit.pop()
            if url not in self.visited:
                self.visit_url(url)
                time.sleep(2)  # Esperar 2 segundos entre solicitudes

        logging.info("Crawling completed. Found URLs:")
        for visited_url in self.visited:
            logging.info(visited_url)

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python crawler.py <start_url>")
        sys.exit(1)

    start_url = sys.argv[1]
    crawler = WebCrawler(start_url)
    crawler.crawl()
