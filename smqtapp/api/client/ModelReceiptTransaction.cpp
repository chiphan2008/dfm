/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */


#include "ModelReceiptTransaction.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelReceiptTransaction::ModelReceiptTransaction(QString* json) {
    init();
    this->fromJson(*json);
}

ModelReceiptTransaction::ModelReceiptTransaction() {
    init();
}

ModelReceiptTransaction::~ModelReceiptTransaction() {
    this->cleanup();
}

void
ModelReceiptTransaction::init() {
    ticket_number = new QString("");
    type = new QString("");
    created_at = NULL;
    amount = 0.0;
}

void
ModelReceiptTransaction::cleanup() {
    if(ticket_number != nullptr) {
        delete ticket_number;
    }
    if(type != nullptr) {
        delete type;
    }
    if(created_at != nullptr) {
        delete created_at;
    }

}

ModelReceiptTransaction*
ModelReceiptTransaction::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelReceiptTransaction::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&ticket_number, pJson["ticket_number"], "QString", "QString");
    ::api::setValue(&type, pJson["type"], "QString", "QString");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&amount, pJson["amount"], "double", "");
}

QString
ModelReceiptTransaction::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelReceiptTransaction::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    toJsonValue(QString("ticket_number"), ticket_number, obj, QString("QString"));
    toJsonValue(QString("type"), type, obj, QString("QString"));
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    obj->insert("amount", QJsonValue(amount));

    return obj;
}

QString*
ModelReceiptTransaction::getTicketNumber() {
    return ticket_number;
}
void
ModelReceiptTransaction::setTicketNumber(QString* ticket_number) {
    this->ticket_number = ticket_number;
}

QString*
ModelReceiptTransaction::getType() {
    return type;
}
void
ModelReceiptTransaction::setType(QString* type) {
    this->type = type;
}

QDateTime*
ModelReceiptTransaction::getCreatedAt() {
    return created_at;
}
void
ModelReceiptTransaction::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

double
ModelReceiptTransaction::getAmount() {
    return amount;
}
void
ModelReceiptTransaction::setAmount(double amount) {
    this->amount = amount;
}


}

