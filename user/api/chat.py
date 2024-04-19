import os

from dotenv import load_dotenv
from langchain.chains import RetrievalQA
from langchain_community.document_loaders import PyPDFLoader
from langchain_openai import OpenAIEmbeddings, ChatOpenAI
from langchain_pinecone import PineconeVectorStore
from langchain_text_splitters import CharacterTextSplitter
from openai import OpenAI
from pinecone import Pinecone

load_dotenv()
OPENAI_API_KEY = os.getenv("OPENAI_API_KEY")
PINECONE_API_KEY = os.getenv("PINECONE_API_KEY")

client = OpenAI(api_key=OPENAI_API_KEY)
pc = Pinecone(api_key=PINECONE_API_KEY)
index_name = "edu-pdf-index"
index = pc.Index(index_name)


def process_pdf(pdf_file):
    loader = PyPDFLoader(pdf_file)
    documents = loader.load()
    text_splitter = CharacterTextSplitter(chunk_size=100, chunk_overlap=0)
    split_documents = text_splitter.split_documents(documents)
    return split_documents


def create_upload_embedding(index_title, text_docs):
    embeddings = OpenAIEmbeddings(
        model="text-embedding-3-small",
        openai_api_key=OPENAI_API_KEY
    )
    embed_store = PineconeVectorStore(pinecone_api_key=PINECONE_API_KEY, index_name=index_title, embedding=embeddings,
                                      namespace="ns1")
    embed_store.add_documents(documents=text_docs)
    return embed_store


def provide_answer(user_question, vector_store):
    llm = ChatOpenAI(
        openai_api_key=OPENAI_API_KEY,
        model_name='gpt-3.5-turbo',
        temperature=0.0
    )
    qa = RetrievalQA.from_chain_type(
        llm=llm,
        chain_type="stuff",
        retriever=vector_store.as_retriever()
    )
    reply = qa.invoke(user_question)['result']
    return reply


PDF_FILE_PATH = "sample.pdf"
docs = process_pdf(pdf_file=PDF_FILE_PATH)
vectorstore = create_upload_embedding(index_title=index_name, text_docs=docs)

USER_QUERY = "What is science?"
response = provide_answer(user_question=USER_QUERY, vector_store=vectorstore)

content = f"""
You are a helpful education assistant who knows a lot about Physics, Chemistry, Biology and other relevant courses offered in colleges. Give answers that are understandable and clear.
However, wile answering questions, ensure that you use: {response} and keep to the context unless the answer to the 
question could not be found in {response}
"""
response = client.chat.completions.create(
    model="gpt-3.5-turbo",
    messages=[
        {"role": "system", "content": content},
        {"role": "user", "content": "Which great Scientist developed Special Relativity?"},
        {"role": "assistant",
            "content": "Special Relativity was developed by Albert Einstein"},
        {"role": "user", "content": USER_QUERY}
    ]
)

BOT_ANSWER = response.choices[0].message.content
print(BOT_ANSWER)
