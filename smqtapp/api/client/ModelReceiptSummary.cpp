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


#include "ModelReceiptSummary.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelReceiptSummary::ModelReceiptSummary(QString* json) {
    init();
    this->fromJson(*json);
}

ModelReceiptSummary::ModelReceiptSummary() {
    init();
}

ModelReceiptSummary::~ModelReceiptSummary() {
    this->cleanup();
}

void
ModelReceiptSummary::init() {
    price = new QString("");
    quantily = 0;
    total_price = 0.0;
}

void
ModelReceiptSummary::cleanup() {
    if(price != nullptr) {
        delete price;
    }


}

ModelReceiptSummary*
ModelReceiptSummary::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelReceiptSummary::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&price, pJson["price"], "QString", "QString");
    ::api::setValue(&quantily, pJson["quantily"], "qint32", "");
    ::api::setValue(&total_price, pJson["total_price"], "double", "");
}

QString
ModelReceiptSummary::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelReceiptSummary::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    toJsonValue(QString("price"), price, obj, QString("QString"));
    obj->insert("quantily", QJsonValue(quantily));
    obj->insert("total_price", QJsonValue(total_price));

    return obj;
}

QString*
ModelReceiptSummary::getPrice() {
    return price;
}
void
ModelReceiptSummary::setPrice(QString* price) {
    this->price = price;
}

qint32
ModelReceiptSummary::getQuantily() {
    return quantily;
}
void
ModelReceiptSummary::setQuantily(qint32 quantily) {
    this->quantily = quantily;
}

double
ModelReceiptSummary::getTotalPrice() {
    return total_price;
}
void
ModelReceiptSummary::setTotalPrice(double total_price) {
    this->total_price = total_price;
}


}

