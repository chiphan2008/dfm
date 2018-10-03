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


#include "ModelCompanyUpdate.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelCompanyUpdate::ModelCompanyUpdate(QString* json) {
    init();
    this->fromJson(*json);
}

ModelCompanyUpdate::ModelCompanyUpdate() {
    init();
}

ModelCompanyUpdate::~ModelCompanyUpdate() {
    this->cleanup();
}

void
ModelCompanyUpdate::init() {
    id = 0L;
    name = new QString("");
    address = new QString("");
    tax_code = new QString("");
    phone = new QString("");
    logo = new QString("");
    email = new QString("");
    lat = 0.0f;
    lng = 0.0f;
}

void
ModelCompanyUpdate::cleanup() {

    if(name != nullptr) {
        delete name;
    }
    if(address != nullptr) {
        delete address;
    }
    if(tax_code != nullptr) {
        delete tax_code;
    }
    if(phone != nullptr) {
        delete phone;
    }
    if(logo != nullptr) {
        delete logo;
    }
    if(email != nullptr) {
        delete email;
    }


}

ModelCompanyUpdate*
ModelCompanyUpdate::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelCompanyUpdate::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&name, pJson["name"], "QString", "QString");
    ::api::setValue(&address, pJson["address"], "QString", "QString");
    ::api::setValue(&tax_code, pJson["tax_code"], "QString", "QString");
    ::api::setValue(&phone, pJson["phone"], "QString", "QString");
    ::api::setValue(&logo, pJson["logo"], "QString", "QString");
    ::api::setValue(&email, pJson["email"], "QString", "QString");
    ::api::setValue(&lat, pJson["lat"], "float", "");
    ::api::setValue(&lng, pJson["lng"], "float", "");
}

QString
ModelCompanyUpdate::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelCompanyUpdate::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    toJsonValue(QString("name"), name, obj, QString("QString"));
    toJsonValue(QString("address"), address, obj, QString("QString"));
    toJsonValue(QString("tax_code"), tax_code, obj, QString("QString"));
    toJsonValue(QString("phone"), phone, obj, QString("QString"));
    toJsonValue(QString("logo"), logo, obj, QString("QString"));
    toJsonValue(QString("email"), email, obj, QString("QString"));
    obj->insert("lat", QJsonValue(lat));
    obj->insert("lng", QJsonValue(lng));

    return obj;
}

qint64
ModelCompanyUpdate::getId() {
    return id;
}
void
ModelCompanyUpdate::setId(qint64 id) {
    this->id = id;
}

QString*
ModelCompanyUpdate::getName() {
    return name;
}
void
ModelCompanyUpdate::setName(QString* name) {
    this->name = name;
}

QString*
ModelCompanyUpdate::getAddress() {
    return address;
}
void
ModelCompanyUpdate::setAddress(QString* address) {
    this->address = address;
}

QString*
ModelCompanyUpdate::getTaxCode() {
    return tax_code;
}
void
ModelCompanyUpdate::setTaxCode(QString* tax_code) {
    this->tax_code = tax_code;
}

QString*
ModelCompanyUpdate::getPhone() {
    return phone;
}
void
ModelCompanyUpdate::setPhone(QString* phone) {
    this->phone = phone;
}

QString*
ModelCompanyUpdate::getLogo() {
    return logo;
}
void
ModelCompanyUpdate::setLogo(QString* logo) {
    this->logo = logo;
}

QString*
ModelCompanyUpdate::getEmail() {
    return email;
}
void
ModelCompanyUpdate::setEmail(QString* email) {
    this->email = email;
}

float
ModelCompanyUpdate::getLat() {
    return lat;
}
void
ModelCompanyUpdate::setLat(float lat) {
    this->lat = lat;
}

float
ModelCompanyUpdate::getLng() {
    return lng;
}
void
ModelCompanyUpdate::setLng(float lng) {
    this->lng = lng;
}


}

